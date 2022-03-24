import React from "react";

const CommanderObtainedFromWidget = props => <div className="col-lg-3">
    <div className="info-box">
        <span className={"info-box-icon bg-grey"}><i className="fas fa-envelope"/></span>
        <div className="info-box-content">
            <span className="info-box-text">Obtained From</span>
            <span className="info-box-number">{props.commander.obtained_from}</span>
        </div>
    </div>
</div>

export default CommanderObtainedFromWidget;