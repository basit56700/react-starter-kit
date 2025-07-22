import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { AgGridReact } from 'ag-grid-react';
import { ColDef } from 'ag-grid-community';
import { ModuleRegistry, AllCommunityModule } from 'ag-grid-community'; // ✅ AG Grid v34+ fix

// Register all AG Grid Community modules (v34+ requirement)
ModuleRegistry.registerModules([AllCommunityModule]);

// AG Grid styles
import 'ag-grid-community/styles/ag-grid.css';
import 'ag-grid-community/styles/ag-theme-alpine.css';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

// Column definitions
const columnDefs: ColDef[] = [
    { headerName: 'ID', field: 'id', sortable: true, filter: true },
    { headerName: 'Name', field: 'name', sortable: true, filter: true },
    { headerName: 'Department', field: 'department', sortable: true, filter: true },
    { headerName: 'Email', field: 'email', sortable: true, filter: true },
];

// Sample row data
const rowData = [
    { id: 1, name: 'Alice Johnson', department: 'HR', email: 'alice@example.com' },
    { id: 2, name: 'Bob Smith', department: 'Finance', email: 'bob@example.com' },
    { id: 3, name: 'Charlie Brown', department: 'Engineering', email: 'charlie@example.com' },
];

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="p-4">
                <div
                    className="ag-theme-alpine rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                    style={{ height: 500, width: '100%' }}
                >
                    <AgGridReact
                        columnDefs={columnDefs}
                        rowData={rowData}
                        pagination={true}
                        paginationPageSize={10}
                        domLayout="autoHeight"
                    />
                </div>
            </div>
        </AppLayout>
    );
}
