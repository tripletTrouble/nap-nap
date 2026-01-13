import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';
import { ComputedRef } from 'vue';

export interface Auth {
    user: User;
    can?: Record<string, boolean>;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
    isVisible?: ComputedRef<boolean>;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
    store?: Store;
};

export interface Store {
    id: number;
    name: string;
    tagline: string;
    code: string;
    address: string;
    created_at: string;
    updated_at: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    deleted_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface StoreSetting {
    id: number;
    store_id: number;
    key: string;
    value: string;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface LaravelPaginationMeta {
    current_page: number;
    from: number | null;
    last_page: number;
    links: PaginationLink[];
    path: string;
    per_page: number;
    to: number | null;
    total: number;
}

export interface LaravelPaginationLinks {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
}

export type Paginated<T> = {
    data: T[];
    meta: LaravelPaginationMeta;
    links: LaravelPaginationLinks;
};
