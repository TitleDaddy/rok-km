import React from "react";
import GovernorOwnedKingdomBox from "../Kingdom/GovernorOwnedKingdomBox";

const KingdomHeader = props => {

    return (
        <div className="col-lg-12">
            <div className={"row"}>
                <div className={"box"}>
                    <div className={"box-header"}>
                        <h3 className={"box-title text-center"}>Kingdom {props.kingdom.number}</h3>
                    </div>
                    <div className={"box-body with-border"}>
                    </div>
                    <div className={"box-footer"}>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default KingdomHeader;