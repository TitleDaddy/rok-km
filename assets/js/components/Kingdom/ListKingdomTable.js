import DataTable from "react-data-table-component";
import React from "react";
import BackendApi from "../../lib/BackendApi";

const columns = [
    {name: 'Number', selector: row => row.number, sortable: true},
    {name: 'Seed', selector: row => row.seed, sortable: true},
    {name: 'Council Driven', selector: row => row.council_driven ? 'Yes' : 'No', sortable: true},
    {name: 'Focus', selector: row => row.focus, sortable: true},
    {name: 'Migration Status', selector: row => row.migration_status, sortable: true},
    {name: '', selector: row => <a href={"/kingdom/" + row.number} className={"btn btn-primary"}>View</a>}
];

const ListKingdomsTable = props =>
    <DataTable
        columns={columns}
        data={props.kingdoms}
        keyField={'number'}
        striped={true}
        highlightOnHover={true}
        defaultSortFieldId={1}
        pagination
        dense={false}
        actions={props.actions}
    />

export default ListKingdomsTable;
