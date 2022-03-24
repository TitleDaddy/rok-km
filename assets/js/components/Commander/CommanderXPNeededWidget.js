import React from "react";

const CommanderXPNeededWidget = props => <div className="col-lg-3">
    <div className="info-box">
        <span className={"info-box-icon bg-aqua"}><i className="fas fa-envelope"/></span>
        <div className="info-box-content">
            <span className="info-box-text">XP to 60</span>
            <span className="info-box-number">{props.commander.xp_needed} XP</span>
        </div>
    </div>
</div>

export default CommanderXPNeededWidget;