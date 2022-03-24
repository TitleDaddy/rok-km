import {Controller} from "stimulus";
import ReactDOM from "react-dom";
import React from "react";
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";
import GovernorHeader from "../../components/Governors/GovernorHeader";
import GovernorAllianceWidget from "../../components/Governors/GovernorAllianceWidget";
import GovernorKingdomWidget from "../../components/Governors/GovernorKingdomWidget";
import GovernorPowerWidget from "../../components/Governors/GovernorPowerWidget";
import GovernorOwnedKingdomBox from "../../components/Kingdom/GovernorOwnedKingdomBox";


const Page = props => {
    return <div className={"row"}>
        <GovernorHeader governor={props.governor} />
        <GovernorAllianceWidget governor={props.governor} />
        <GovernorKingdomWidget governor={props.governor} />
        <GovernorPowerWidget governor={props.governor} />
        {/* Alliance + Kd Calendar */}
        {/* Alliance + Kd News */}
        {/* KvK Info + Stats */}
        {/* Commander Info */}
        {/* RSS Calculator */}
        {/* Speedup Calculator */}

    </div>
}

export default class extends Controller {
    static values = {
        props: String
    }
    connect = () => {
        return BackendApi.V1.Governors.get(this.propsValue)
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page governor={data} />, this.element);
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