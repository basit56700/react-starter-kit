import { useState, useRef } from 'react';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';

import { AgGridReact } from 'ag-grid-react';
import { AllCommunityModule, ModuleRegistry, type GridOptions, type ColDef } from 'ag-grid-community';
import { themeQuartz } from 'ag-grid-community';

// ✅ Register Community Modules
ModuleRegistry.registerModules([AllCommunityModule]);

// ✅ Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' },
  { title: 'Employees', href: '/hr/employee' },
];

// ✅ Apply theme
const myTheme = themeQuartz.withParams({
  headerHeight: '30px',
});

// ✅ Define Row Data Type
interface IRow {
  make: string;
  model: string;
  price: number;
  electric: boolean;
}

export default function EmployeeList() {
  const gridRef = useRef<AgGridReact<IRow>>(null); // ✅ Grid API Ref

  const [rowData] = useState<IRow[]>([
    { make: 'Tesla', model: 'Model Y', price: 64950, electric: true },
    { make: 'Ford', model: 'F-Series', price: 33850, electric: false },
    { make: 'Toyota', model: 'Corolla', price: 29600, electric: false },
    { make: 'Mercedes', model: 'EQA', price: 48890, electric: true },
    { make: 'Fiat', model: '500', price: 15774, electric: false },
    { make: 'Nissan', model: 'Juke', price: 20675, electric: false },
  ]);

  // ✅ GridOptions for selection
  const gridOptions: GridOptions<IRow> = {
    rowSelection: {
      type: 'multiple',
      checkboxes: true,
      headerCheckbox: true,
      mode: 'multiRow',
    },
  };

  // ✅ Column Definitions
  const [columnDefs] = useState<ColDef<IRow>[]>([
    
    {
      headerName: 'Sr. No.',
      valueGetter: (params) => params.node?.rowIndex + 1,
      sortable: true,
      filter: true,
    },
    { field: 'make', sortable: true, filter: true },
    { field: 'model', sortable: true, filter: true },
    { field: 'price', sortable: true, filter: true },
    { field: 'electric', sortable: true, filter: true },
  ]);

  // ✅ Default Column Definition
  const defaultColDef: ColDef = {
    editable: true,
    flex: 1,
    minWidth: 100,
    filter: true,
    floatingFilter: true,
  };

  // ✅ CSV Export Function
  const exportToCsv = () => {
    gridRef.current?.api.exportDataAsCsv({
      fileName: 'employees.csv',
      onlySelected: false, // true if you want to export selected rows only
    });
  };

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Employees" />

      {/* ✅ Export Button */}
      <div className="flex justify-end mt-4">
        <button
          onClick={exportToCsv}
          className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
          Export to CSV
        </button>
      </div>

      {/* ✅ AG Grid */}
      <div className="ag-theme-alpine w-full h-[500px] mt-4 rounded shadow border border-gray-200 dark:border-sidebar-border p-2">
        <AgGridReact
          ref={gridRef}
          rowData={rowData}
          columnDefs={columnDefs}
          defaultColDef={defaultColDef}
          gridOptions={gridOptions}
          theme={myTheme}
          animateRows={true}
        />
      </div>
    </AppLayout>
  );
}
