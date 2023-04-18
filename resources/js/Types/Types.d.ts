import type Echo from 'laravel-echo';

export type UserRole = 'ADMIN' | 'USER' | 'OWNER';

declare global {

    type User = {
        id: number;
        name?: string;
        email?: string;
        user_role?: UserRole;
    };

    interface Window {
        Echo: Echo;
        axios: axios;
    }

    declare namespace svelteHTML {
        interface HTMLAttributes<T> {
            'on:outclick'?: () => void;
        }
    }

}