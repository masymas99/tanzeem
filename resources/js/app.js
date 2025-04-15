import './bootstrap';
import '../css/app.css';

import React from 'react';
import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';

// Initialize Bootstrap components
import * as bootstrap from 'bootstrap';

createInertiaApp({
    resolve: (name) => import(`./Pages/${name}.jsx`),
    setup: ({ el, App, props }) => {
        const root = createRoot(el);
        root.render(React.createElement(App, props));
        
        // Initialize Bootstrap components after rendering
        // Initialize all tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize all popovers
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        // Initialize all dropdowns
        const dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
        dropdownTriggerList.map(function (dropdownTriggerEl) {
            return new bootstrap.Dropdown(dropdownTriggerEl);
        });

        // Initialize all modals
        const modalTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]'));
        modalTriggerList.map(function (modalTriggerEl) {
            return new bootstrap.Modal(modalTriggerEl);
        });

        // Initialize all carousels
        const carouselList = [].slice.call(document.querySelectorAll('.carousel'));
        carouselList.map(function (carouselEl) {
            return new bootstrap.Carousel(carouselEl);
        });

        // Initialize all collapsibles
        const collapsibleList = [].slice.call(document.querySelectorAll('[data-bs-toggle="collapse"]'));
        collapsibleList.map(function (collapsibleEl) {
            return new bootstrap.Collapse(collapsibleEl);
        });
    }
});
