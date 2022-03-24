import React from "react";
import GovernorOwnedKingdomBox from "../Kingdom/GovernorOwnedKingdomBox";

const CommanderHeader = props => {
    const headerPush = props.governor.owner_of_kingdoms ? '1' : '4';

    return (
        <div className="col-lg-12">
            <div className={"row"}>
                <GovernorOwnedKingdomBox governor={props.governor}/>
                <div className={`col-lg-4 col-lg-push-${headerPush}`}>
                    <div className={"box"}>
                        <div className={"box-header"}>
                            <h3 className={"box-title text-center"}>Governor {props.governor.name} ({props.governor.game_id})</h3>
                        </div>
                        <div className={"box-body with-border pull-right"}>
                        </div>
                        <div className={"box-footer"}>
                            <div className={"text-center"}>{props.governor.type}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default CommanderHeader;