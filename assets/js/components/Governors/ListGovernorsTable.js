import DataTable from "react-data-table-component";
import React from "react";

const columns = [
    {name: 'Name', selector: row => row.name, sortable: true},
    {name: 'In-Game ID', selector: row => row.game_id, sortable: true},
    {name: 'Power', selector: row => row.power, sortable: true},
    {name: 'Type', selector: row => row.type, sortable: true},
    {name: '', selector: row => <a href={"/governor/" + row.id} className={"btn btn-primary"}>View Governor Dashboard</a> }
];

const ListGovernorsTable = props =>
    <DataTable
        columns={columns}
        data={props.governors}
        keyField={'name'}
        striped={true}
        highlightOnHover={true}
        defaultSortFieldId={1}
        pagination
        dense={false}
        actions={props.actions}
    />

export default ListGovernorsTable;