import React from "react";

const GovernorAllianceWidget = props => {

    function renderAlliance() {
        if (props.governor.alliance) {
            return props.governor.alliance.name;
        }
        return <button className={"btn btn-sm"}>Join an Alliance</button>
    }

    return (
        <div className="col-lg-4">
            <div className="info-box">
                <span className={"info-box-icon bg-aqua"}><i className="fas fa-envelope"/></span>
                <div className="info-box-content">
                    <span className="info-box-text">Alliance</span>
                    <span className="info-box-number">{renderAlliance()}</span>
                </div>
            </div>
        </div>
    )
}
export default GovernorAllianceWidget;