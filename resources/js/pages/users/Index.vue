<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableHead, TableHeader, TableRow, TableCell } from '@/components/ui/table';
import { confirm } from '@/composables/useConfirmation';
import AppLayout from '@/layouts/AppLayout.vue';
import * as ur from '@/routes/users';
import { BreadcrumbItem, Paginated, User } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

const breadcrumbItems: BreadcrumbItem[] = [
  {
    title: 'Daftar pengguna',
    href: ur.index().url,
  },
];
defineProps<{
  users: Paginated<User>;
}>();

async function handleActivation(user: User) {
  confirm({
    title: user.deleted_at ? 'Aktifkan pengguna ini?' : 'Nonaktifkan pengguna ini?',
    description: user.deleted_at
      ? 'Pengguna ini akan diaktifkan kembali dan dapat mengakses aplikasi.'
      : 'Pengguna ini tidak akan dapat mengakses aplikasi.',
    confirmText: user.deleted_at ? 'Aktifkan' : 'Nonaktifkan',
    cancelText: 'Batal',
  }).then((confirmed) => {
    if (confirmed) {
      if (user.deleted_at) {
        router.patch(ur.activate({ user_id: user.id }).url, undefined, {
          onFlash: ({success}) => {
            toast.success(success as string);
          },
          onError: ({error}) => {
            toast.error(error as string);
          }
        });
      } else {
        router.patch(ur.deactivate({ user_id: user.id }).url, undefined, {
          onFlash: ({success}) => {
            toast.success(success as string);
          },
          onError: ({error}) => {
            toast.error(error as string);
          }
        });
      }
    }
  })
}
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbItems">

    <Head title="Daftar pengguna" />
    <div class="min-h-screen p-4">
      <Heading title="Daftar pengguna" description="Kelola pengguna aplikasi Anda" />
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Nama</TableHead>
            <TableHead class="hidden md:table-cell">Email</TableHead>
            <TableHead>Aksi</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="user in users.data" :key="user.id">
            <TableCell>
              <div class="truncate">{{ user.name }}</div>
              <div class="md:hidden text-xs italic">{{ user.email }}</div>
            </TableCell>
            <TableCell class="hidden md:table-cell">{{ user.email }}</TableCell>
            <TableCell>
              <Button :variant="!user.deleted_at ? 'destructive' : 'default'" size="sm" @click="handleActivation(user)">
                {{ user.deleted_at ? 'Aktifkan' : 'Nonaktifkan' }}
              </Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </AppLayout>
</template>