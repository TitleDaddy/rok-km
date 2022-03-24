import {Controller} from "stimulus";
import ReactDOM from "react-dom";
import React, {useEffect, useState} from "react";
import {CreateCommanderModal, ShowModalButton} from "../../components/Commander/CreateCommanderModal";
import ListCommandersTable from "../../components/Commander/ListCommandersTable";
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";


const Page = props => {
    const [isAdmin, setIsAdmin] = useState(false);
    useEffect(async () => {
        setIsAdmin(await BackendApi.V1.User.amIAdmin());
    }, [])

    return <div>
        <CreateCommanderModal />
        <ListCommandersTable commanders={props.commanders} actions={isAdmin ? ShowModalButton() : null} />
    </div>
}


export default class extends Controller {
    connect = () => {
        return BackendApi.V1.Commander.getAll()
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page commanders={data} />, this.element);
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