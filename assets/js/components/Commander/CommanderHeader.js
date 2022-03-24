import commander_logos from "../../domain/commander/commander_logos";
import feature_logos from "../../domain/commander/feature_logos";
import React from "react";

const CommanderHeader = props => <div className="col-lg-12 col-lg-push-4">
    <div className={"row"}>
        <div className={"col-lg-4"}>
            <div className={"box"}>
                <div className={"box-header"}>
                    <h3 className={"box-title justify-content-center"}>{props.commander.name}</h3>
                </div>
                <div className={"box-body with-border pull-right"}>
                    <img className={"img-responsive"} src={commander_logos[props.commander.name]} />
                </div>
                <div className={"box-footer"}>
                    {props.commander.features.map(feature => {
                        return <div className={"col-sm-4"}>
                            <img className={"img-responsive"} src={feature_logos[feature]} />
                            <span>{feature}</span>
                        </div>
                    })}
                </div>
            </div>
        </div>
    </div>
</div>

export default CommanderHeader;