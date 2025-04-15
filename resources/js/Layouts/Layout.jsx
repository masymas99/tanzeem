import React from 'react';
import { Head } from '@inertiajs/react';
import { Link } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';

export default function Layout({ children, title = '' }) {
    return (
        <div className="min-h-screen bg-gray-100">
            <Head title={title} />
            <Navbar />
            <main>
                <div className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    {children}
                </div>
            </main>
        </div>
    );
}
