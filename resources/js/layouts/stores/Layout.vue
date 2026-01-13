<script setup lang="ts">
import { BreadcrumbItem } from '@/types';
import AppLayout from '../AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
  breadcrumbs: Array<BreadcrumbItem>;
}>()

const page = usePage();
const headerData = computed(() => {
  return {
    'heading': `${page.props.store?.name} (${page.props.store?.code ?? 'N/A'})`,
    'description': page.props.store?.address ?? 'Tidak ada informasi alamat',
  };
});
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <Heading :title="headerData.heading" :description="headerData.description" />
      <slot/>
    </div>
  </AppLayout>
</template>