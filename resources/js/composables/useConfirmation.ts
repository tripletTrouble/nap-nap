import { ref } from "vue";

export type ConfirmOptions = {
  title: string;
  description?: string;
  confirmText?: string;
  cancelText?: string;
  onConfirmed?: () => void | Promise<void>;
};

export const isOpen = ref(false);
export const options = ref<ConfirmOptions | null>(null);

let resolveFn: ((value: boolean) => void) | null = null;

export function confirm(opts: ConfirmOptions) {
  options.value = opts;
  isOpen.value = true;

  return new Promise<boolean>((resolve) => {
    resolveFn = resolve;
  });
}

export async function confirmResolve(value: boolean) {
  const onConfirmed = options.value?.onConfirmed;
  try {
    if (value && onConfirmed) {
      await onConfirmed();
    }
  } finally {
    if (resolveFn) resolveFn(value);
    resolveFn = null;
    isOpen.value = false;
    options.value = null;
  }
}

export function useConfirmation() {
  return {
    isOpen,
    options,
    confirm,
    confirmResolve,
  };
}