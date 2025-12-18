<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case VIEW_DASHBOARD = 'view_dashboard';
    case MANAGE_USERS = 'manage_users';
    case EDIT_SETTINGS = 'edit_settings';
    case DELETE_TRANSACTIONS = 'delete_transactions';
    case CANCEL_TRANSACTIONS = 'cancel_transactions';
    case CREATE_TRANSACTIONS = 'create_transactions';

    public function description(): string
    {
        return match($this) {
            self::VIEW_DASHBOARD => 'Permission to view the dashboard',
            self::MANAGE_USERS => 'Permission to manage user accounts',
            self::EDIT_SETTINGS => 'Permission to edit application settings',
            self::DELETE_TRANSACTIONS => 'Permission to delete transactions',
            self::CREATE_TRANSACTIONS => 'Permission to create new transactions',
            self::CANCEL_TRANSACTIONS => 'Permission to cancel transactions',
        };
    }
}
