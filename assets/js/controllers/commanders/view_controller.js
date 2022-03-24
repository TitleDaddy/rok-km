import {Controller} from "stimulus";
import axios from "axios";
import ReactDOM from "react-dom";
import React from "react";
import CommanderHeader from "../../components/Commander/CommanderHeader";
import CommanderRarityWidget from "../../components/Commander/CommnderRarityWidget";
import CommanderXPNeededWidget from "../../components/Commander/CommanderXPNeededWidget";
import CommanderHeadsWidget from "../../components/Commander/CommandersHeadsWidget";
import CommanderObtainedFromWidget from "../../components/Commander/CommanderObtainedFromWidget";
import CommanderSkillsTable from "../../components/Commander/CommanderSkillsTable";
import CommanderPairingTable from "../../components/Commander/CommanderPairingTable";
import CommanderTalentTreeTable from "../../components/Commander/CommanderTalentTreeTable";
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";


const Page = props => {
    return <div className={"row"}>
        <CommanderHeader commander={props.commander} />
        <CommanderRarityWidget commander={props.commander} />
        <CommanderXPNeededWidget commander={props.commander} />
        <CommanderHeadsWidget commander={props.commander} />
        <CommanderObtainedFromWidget commander={props.commander} />
        <CommanderSkillsTable commander={props.commander} />
        <CommanderPairingTable commander={props.commander} />
        <CommanderTalentTreeTable commander={props.commander} />
    </div>
}

export default class extends Controller {
    static values = {
        props: String
    }
    connect = () => {
        return BackendApi.V1.Commander.get(this.propsValue)
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page commander={data} />, this.element);
            }).catch(e => {
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