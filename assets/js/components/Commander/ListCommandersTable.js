import DataTable from "react-data-table-component";
import React from "react";

const columns = [
    {name: 'Name', selector: row => row.name, sortable: true},
    {name: 'Rarity', selector: row => row.rarity, sortable: true},
    {name: 'Talent Tree Types', selector: row => row.features.join(', '), sortable: true, grow: 2},
    {name: 'Obtainable From', selector: row => row.obtained_from, sortable: true},
    {name: 'Kingdom Age on Release', selector: row => row.kingdom_age > 1 ? row.kingdom_age + ' Days' : row.kingdom_age + ' Day', sortable: true},
    {name: '', selector: row => <a href={"/commander/" + row.name} className={"btn btn-primary"}>View</a> }
];

const ListCommandersTable = props =>
    <DataTable
        columns={columns}
        data={props.commanders}
        keyField={'name'}
        striped={true}
        highlightOnHover={true}
        defaultSortFieldId={1}
        pagination
        dense={false}
        actions={props.actions}
    />

export default ListCommandersTable;