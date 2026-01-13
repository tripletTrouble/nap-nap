<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import SettingLayout from '@/layouts/stores/Layout.vue';
import store from '@/routes/store';
import { BreadcrumbItem, StoreSetting } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { CheckCheck } from 'lucide-vue-next';
import { toast } from 'vue-sonner';

const breadcrumbs: Array<BreadcrumbItem> = [
  {
    title: 'Setelan Toko',
    href: store.settings.index().url,
  },
];
const props = defineProps<{
  settings: Array<{
    'key': string;
    'label': string;
    'description': string;
  }>;
  settingValues: Array<StoreSetting>;
}>();
const page = usePage();

// Define form fields based on settings keys
const fields: Record<string, boolean> = {};

// Loops through settings to initialize fields
props.settings.forEach((setting) => {
  fields[setting.key] = props.settingValues.some(
    (sv) => sv.key === setting.key && sv.value === '1'
  );
});

// Define form using the initialized fields
const form = useForm(fields);
// Handle save action
function saveSettings() {
  form.post(store.settings.update(page.props.store!.id).url, {
    onError: () => {
      toast.error('Gagal menyimpan setelan toko. Silakan coba lagi.');
    },
    onFlash: ({success}) => {
      toast.success(success || 'Setelan toko berhasil disimpan.');
    }
  });
};
</script>

<template>
  <SettingLayout :breadcrumbs="breadcrumbs">
    <Card>
      <CardHeader>
        <CardTitle class="text-xl">Setelan toko</CardTitle>
        <CardDescription>Atur setelan toko sesuai kebutuhan kamu.</CardDescription>
      </CardHeader>
      <CardContent>
        <div v-for="setting in settings" :key="setting.key"
          class="grid grid-cols-[4fr_1fr] items-center gap-4 mb-3 p-3 border-b">
          <div class="grid space-y-0.5">
            <div class="text-lg font-bold">{{ setting.label }}</div>
            <div class="text-sm text-muted-foreground">{{ setting.description }}</div>
          </div>
          <div class="text-end">
            <Switch v-model="form[setting.key]" value="1" />
          </div>
        </div>
      </CardContent>
      <CardFooter>
        <div class="flex justify-end w-full">
          <Button @click="saveSettings">
            <CheckCheck />
            Simpan
          </Button>
        </div>
      </CardFooter>
    </Card>
  </SettingLayout>
</template>