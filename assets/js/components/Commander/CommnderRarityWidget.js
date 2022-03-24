import React from "react";

function getRarityWidgetClass(rarity) {
    switch(rarity) {
        case 'Legendary':
            return 'info-box-icon bg-orange';
        case 'Epic':
            return 'info-box-icon bg-purple';
        case 'Elite':
            return 'info-box-icon bg-blue';
        case 'Advanced':
            return 'info-box-icon bg-green';
    }
}

const CommanderRarityWidget = props => <div className="col-lg-3">
    <div className="info-box">
        <span className={getRarityWidgetClass(props.commander.rarity)}><i className="fas fa-envelope"/></span>
        <div className="info-box-content">
            <span className="info-box-text">Rarity</span>
            <span className="info-box-number">{props.commander.rarity}</span>
        </div>
    </div>
</div>

export default CommanderRarityWidget;