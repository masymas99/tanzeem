import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import * as bootstrap from 'bootstrap';

export default function Navbar() {
    const page = usePage();
    const currentRoute = page.url;
    const { post } = useForm();

    const isActive = (routeName) => {
        return currentRoute === routeName;
    };

    const handleLogout = () => {
        post('/logout');
    };

    React.useEffect(() => {
        // Initialize Bootstrap components
        const collapseElement = document.getElementById('navbarSupportedContent');
        if (collapseElement) {
            new bootstrap.Collapse(collapseElement, {
                toggle: false
            });
        }

        // Initialize navbar toggler
        const navbarToggler = document.querySelector('.navbar-toggler');
        if (navbarToggler) {
            navbarToggler.addEventListener('click', () => {
                const collapse = new bootstrap.Collapse(collapseElement);
                collapse.toggle();
            });
        }
    }, []);

    return (
        <nav className="navbar navbar-expand-lg" style={{ backgroundColor: '#6A5DCF', fontFamily: '"Cairo", Courier, monospace' }}>
            <div className="container-fluid">
                <Link href="/employees" className="navbar-brand text-white">
                    T A N Z E E M
                </Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <div className="navbar-nav ms-auto">
                        <ul className="navbar-nav mb-2 mb-lg-0">
                            <li className="nav-item text-white">
                                <Link href="/dashboard" 
                                      className={`nav-link text-white ${isActive('/dashboard') ? 'active' : ''}`}
                                      aria-current="page"
                                      preserveScroll={true}>
                                    لوحة التحكم
                                </Link>
                            </li>
                            <li className="nav-item text-white">
                                <Link href="/salaries" 
                                      className={`nav-link text-white ${isActive('/salaries') ? 'active' : ''}`}
                                      aria-current="page"
                                      preserveScroll={true}>
                                    المرتبات
                                </Link>
                            </li>
                            <li className="nav-item ms-3">
                                <Link href="/attendance" 
                                      className={`nav-link text-white ${isActive('/attendance') ? 'active' : ''}`}
                                      preserveScroll={true}>
                                    الحضور
                                </Link>
                            </li>
                            <li className="nav-item ms-3">
                                <Link href="/holidays" 
                                      className={`nav-link text-white ${isActive('/holidays') ? 'active' : ''}`}
                                      preserveScroll={true}>
                                    الأجازات
                                </Link>
                            </li>
                            <li className="nav-item ms-3">
                                <Link href="/settings" 
                                      className={`nav-link text-white ${isActive('/settings') ? 'active' : ''}`}
                                      preserveScroll={true}>
                                    الإعدادات
                                </Link>
                            </li>
                            <li className="nav-item ms-3">
                                <Link href="/employees" 
                                      className={`nav-link text-white ${isActive('/employees') ? 'active' : ''}`}
                                      preserveScroll={true}>
                                    الموظفين
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <button onClick={handleLogout} className="btn btn-danger ms-3" type="button">
                                <i className="fa fa-sign-out" aria-hidden="true"> تسجيل الخروج</i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}
