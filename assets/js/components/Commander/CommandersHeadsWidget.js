import React from "react";

const CommandersHeadsWidget = props => <div className="col-lg-3">
    <div className="info-box">
        <span className={"info-box-icon bg-red"}><i className="fas fa-envelope"/></span>
        <div className="info-box-content">
            <span className="info-box-text">Heads for Expertise</span>
            <span className="info-box-number">{props.commander.heads_needed} XP</span>
        </div>
    </div>
</div>

export default CommandersHeadsWidget;