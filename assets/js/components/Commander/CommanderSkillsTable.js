import React from "react";

const CommanderSkillsTable = props => <div className={"col-lg-12"}>
    <div className={"box"}>
        <div className={"box-header with-border"}>
            <h3 className={"box-title"}>{props.commander.name} Skills</h3>
        </div>
        <div className={"box-body table-responsive"}>
            <table className={"table table-striped"}>
                <tbody>
                {props.commander.skills.map(skill => {
                    return <tr key={"skill-" + skill.index}>
                        <td>{skill.index}</td>
                        <td>{skill.name} ({skill.type})</td>
                        <td>{skill.description}</td>
                        <td>{skill.upgrades.map((upgrade, idx) => <p key={`skill-upgrade-${idx}`}>{upgrade}</p>)}</td>
                    </tr>
                })}
                </tbody>
            </table>
        </div>
    </div>
</div>

export default CommanderSkillsTable;