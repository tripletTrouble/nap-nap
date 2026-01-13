<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import StoreLayout from '@/layouts/stores/Layout.vue';
import store from '@/routes/store';
import { BreadcrumbItem } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { CheckCheck } from 'lucide-vue-next';
import { toast } from 'vue-sonner';

const breadcrumbs: Array<BreadcrumbItem> = [
  {
    title: 'Informasi Umum',
    href: store.edit().url,
  },
];
const page = usePage();
const storeData = page.props.store;
const form = useForm({
  name: storeData!.name || '',
  code: storeData!.code || '',
  tagline: storeData!.tagline || '',
  address: storeData!.address || '',
});
const handleSave = () => {
  form.put(store.update(storeData!.id).url, {
    onError: () => {
      toast.error('Gagal menyimpan perubahan. Silakan coba lagi.');
    },
    onFlash: ({success}) => {
      console.log(success);
      toast.success(success as string);
    }
  });
}
</script>

<template>
  <StoreLayout :breadcrumbs="breadcrumbs">
    <Card>
      <CardHeader>
        <CardTitle>Informasi umum toko</CardTitle>
        <CardDescription>Kelola informasi tokomu di sini</CardDescription>
      </CardHeader>
      <CardContent>
        <div class="grid grid-cols-1 xl:grid-cols-2 items-start gap-5">
          <div class="grid space-y-2">
            <Label for="name">Nama toko</Label>
            <Input type="text" id="name" placeholder="Nama toko" v-model="form.name" />
          </div>
          <div class="grid space-y-2">
            <Label for="code">Kode toko</Label>
            <Input type="text" id="code" placeholder="Kode toko" v-model="form.code" />
          </div>
          <div class="grid space-y-2">
            <Label for="tagline">Tagline toko</Label>
            <Input type="text" id="tagline" placeholder="Tagline toko" v-model="form.tagline" />
          </div>
          <div class="grid space-y-2">
            <Label for="address">Alamat toko</Label>
            <Textarea id="address" placeholder="Alamat toko" v-model="form.address" maxlength="255" />
            <div class="text-right text-xs">{{form.address.length}}/255</div>
          </div>
        </div>
        <div class="flex justify-end mt-4">
          <Button
            :disabled="form.processing"
            @click="handleSave">
            <CheckCheck/>
            Simpan
          </Button>
        </div>
      </CardContent>
    </Card>
  </StoreLayout>
</template>