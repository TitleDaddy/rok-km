import React from "react";

const GovernorPowerWidget = props => <div className="col-lg-4">
    <div className="info-box">
        <span className={"info-box-icon bg-aqua"}><i className="fas fa-envelope"/></span>
        <div className="info-box-content">
            <span className="info-box-text">Power</span>
            <span className="info-box-number">{props.governor.power}</span>
        </div>
    </div>
</div>

export default GovernorPowerWidget;