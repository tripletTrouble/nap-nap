<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import 'vue-sonner/style.css';
import Confirmation from '@/components/Confirmation.vue';
import { Toaster } from '@/components/ui/sonner';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
        <Toaster :rich-colors="true" position="top-right" />
        <Confirmation />
    </AppLayout>
</template>
