import commander_logos from "../../domain/commander/commander_logos";
import React from "react";

const CommanderPairingTable = props =>         <div className={"col-lg-12"}>
    <div className={"box"}>
        <div className={"box-header with-border"}>
            <h3 className={"box-title"}>{props.commander.name} Pairings</h3>
        </div>
        <div className={"box-body table-responsive"}>
            <table className={"table table-striped"}>
                <thead>
                <tr>
                    <th>Primary Commander</th>
                    <th>Secondary Commander</th>
                </tr>
                </thead>
                <tbody>
                {props.commander.pairings.map((pairing, index) => {
                    return <tr key={"pairings-" + index}>
                        <td>
                            <a href={`/commander/${pairing.primary_commander}`}>
                                <img src={commander_logos[pairing.primary_commander]}/>
                                {pairing.primary_commander}
                            </a>
                        </td>
                        <td>
                            <a href={`/commander/${pairing.secondary_commander}`}>
                                <img src={commander_logos[pairing.secondary_commander]} />
                                {pairing.secondary_commander}
                            </a>
                        </td>
                    </tr>
                })}
                </tbody>
            </table>
        </div>
    </div>
</div>

export default CommanderPairingTable;