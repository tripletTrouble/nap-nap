<script setup lang="ts">
import {
  AlertDialog,
  AlertDialogContent,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogDescription,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogFooter,
} from "@/components/ui/alert-dialog";
import { isOpen, options, confirmResolve } from "@/composables/useConfirmation";

const open = isOpen;

async function handleConfirm() {
  await confirmResolve(true);
}

function handleCancel() {
  confirmResolve(false);
}
</script>

<template>
  <AlertDialog v-model:open="open">
    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>{{ options?.title }}</AlertDialogTitle>
        <AlertDialogDescription v-if="options?.description">
          {{ options.description }}
        </AlertDialogDescription>
      </AlertDialogHeader>

      <AlertDialogFooter class="mt-4 flex justify-end gap-2">
        <AlertDialogCancel @click="handleCancel">
          {{ options?.cancelText ?? 'Batal' }}
        </AlertDialogCancel>
        <AlertDialogAction @click="handleConfirm">
          {{ options?.confirmText ?? 'Ya' }}
        </AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>
