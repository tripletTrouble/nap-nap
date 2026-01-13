<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Database, FileSpreadsheet, LayoutGrid, NotepadText, UserSearch } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import users from '@/routes/users';
import store from '@/routes/store';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
];

const storeNavItems: NavItem[] = [
    {
        title: 'Informasi toko',
        href: store.edit().url,
        icon: NotepadText,
    },
    {
        title: 'Master data',
        href: '#',
        icon: Database,
    },
    {
        title: 'Produk',
        href: '#',
        icon: FileSpreadsheet,
    },
];

const userNavItems: NavItem[] = [
    {
        title: 'Daftar Pengguna',
        href: users.index().url,
        icon: UserSearch,
    }
];

const footerNavItems: NavItem[] = [

];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
            <NavMain :items="storeNavItems" label="Manajemen Toko" v-if="$page.props.auth.can?.updateStore" />
            <NavMain :items="userNavItems" label="Manajemen Aplikasi" v-if="$page.props.auth.can?.manageUsers" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
