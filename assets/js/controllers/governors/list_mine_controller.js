import {Controller} from "stimulus";
import ReactDOM from "react-dom";
import React from "react";
import {CreateGovernorModal, ShowModalButton} from "../../components/Governors/CreateGovernorModal";
import ListGovernorsTable from "../../components/Governors/ListGovernorsTable";
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";


const Page = props => {
    return <div>
        <CreateGovernorModal />
        <ListGovernorsTable governors={props.governors} actions={ShowModalButton()} />
    </div>
}


export default class extends Controller {
    connect = () => {
        return BackendApi.V1.Governors.getMine()
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page governors={data} />, this.element);
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