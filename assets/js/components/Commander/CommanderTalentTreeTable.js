import React from "react";

const CommanderTalentTreeTable = props =>         <div className={"col-lg-12"}>
    <div className={"box box-solid"}>
        <div className={"box-header with-border"}>
            <h3 className={"box-title"}>{props.commander.name} Talent Trees</h3>
        </div>
        <div className={"box-body"}>
            <div className={"box-group"} id={"accordion"}>
                {props.commander.talent_trees.map((talent_tree, index) => {
                    return <div className={"panel box box-primary"} key={`talent-tree-${index}`}>
                        <div className={"box-header with-border"}>
                            <h4 className={"box-title"}>
                                <a className={"collapsed"} data-toggle={"collapse"} data-parent={"#accordion"} href={`#view-tree-${index}`}>{talent_tree.name}</a>
                            </h4>
                        </div>
                        <div className={"panel-collapse collapse"} id={`view-tree-${index}`}>
                            <div className={"box-body"}>
                                <img className={"img-responsive"} src={talent_tree.url}/>
                            </div>
                        </div>
                    </div>
                })}
            </div>
        </div>
    </div>
</div>

export default CommanderTalentTreeTable;