import React from "react";

const GovernorOwnedKingdomBox = props => {
    const governor = props.governor;

    if (governor.owner_of_kingdoms) {
        return (
            <div className={"col-lg-3"}>
                <div className={"box"}>
                    <div className={"box-header"}>
                        <h3 className={"box-title"}>Manager of Kingdoms:</h3>
                    </div>
                    <div className={"box-body"}>
                        {governor.owner_of_kingdoms.map(kingdom => {
                            return <p key={`kingdom-${kingdom.number}`}><a
                                href={`/kingdom/${kingdom.number}`}>{kingdom.number}</a></p>
                        })}
                    </div>
                </div>
            </div>
        )
    }
    return null;
}

export default GovernorOwnedKingdomBox;
