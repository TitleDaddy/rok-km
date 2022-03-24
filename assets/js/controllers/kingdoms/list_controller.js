import {Controller} from "stimulus";
import ReactDOM from "react-dom";
import React from "react";
import {CreateKingdomModal, ShowModalButton} from "../../components/Kingdom/CreateKingdomModal";
import ListKingdomsTable from "../../components/Kingdom/ListKingdomTable";
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";


const Page = props => {
    return <div>
        <CreateKingdomModal />
        <ListKingdomsTable kingdoms={props.kingdoms} actions={ShowModalButton()} />
    </div>
}


export default class extends Controller {
    connect = () => {
        return BackendApi.V1.Kingdoms.getAll()
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page kingdoms={data} />, this.element);
            })
            .catch(e => {
                if (e.response) {
                    const errors = e.response.data.errors;
                    if (errors) {
                        errors.forEach(error => showToast(error.message));
                        return;
                    }
                }
                showToast("An Unknown error occurred");
            })
    };
}