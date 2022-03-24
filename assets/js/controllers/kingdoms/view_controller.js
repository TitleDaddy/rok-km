import {Controller} from "stimulus";
import ReactDOM from "react-dom";
import React from "react";
import {CreateKingdomModal, ShowModalButton} from "../../components/Kingdom/CreateKingdomModal";
import ListKingdomsTable from "../../components/Kingdom/ListKingdomTable";
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";
import KingdomHeader from "../../components/Kingdom/KingdomHeader";


const Page = props => {
    return <div>
        <CreateKingdomModal />
        <KingdomHeader kingdom={props.kingdom}/>
    </div>
}


export default class extends Controller {
    static values = {
        props: String
    }
    connect = () => {
        return BackendApi.V1.Kingdoms.get(this.propsValue)
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page kingdom={data} />, this.element);
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