import React, {useEffect, useState} from "react";
import Select from 'react-select'
import BackendApi from "../../lib/BackendApi";
import Toastify from "toastify-js";
import showToast from "../../lib/UI/Toasts";

export const ShowModalButton = () =>
    <button
        type={"button"}
        onClick={() => $('#createKingdomModal').show()}
        className={"btn btn-primary"}
        data-toggle={"modal"}
        data-target={"#createKingdomModal"}>
        Create New Kingdom
    </button>

export const CreateKingdomModal = () => {
    const [number, setNumber] = useState(0);
    const [seed, setSeed] = useState("");
    const [councilDriven, setCouncilDriven] = useState(true);
    const [focus, setFocus] = useState("");
    const [migrationStatus, setMigrationStatus] = useState("");
    const [governorId, setGovernorId] = useState("");
    const [attributes, setAttributes] = useState({
        focus: [],
        migration_status: [],
        seeds: [],
        profiles: [],
    })

    useEffect(async () => {
        try {
            const governorProfilesRes = await BackendApi.V1.Governors.getMine();
            const governorProfiles = governorProfilesRes.data.data;
            const res = await BackendApi.V1.Kingdoms.attributes();
            const data = res.data.data;

            setAttributes({
                focus: data.focus.map((item) => {
                    return {value: item, label: item}
                }),
                migration_status: data.migration_status.map(item => {
                    return {value: item, label: item}
                }),
                seeds: data.seeds.map(item => {
                    return {value: item, label: item};
                }),
                profiles: governorProfiles.map(item => {
                    return {value: item.id, label: `${item.name} (${item.game_id})`};
                }),
            })
        } catch (e) {
            if (e.response) {
                const errors = e.response.data.errors;
                if (errors) {
                    errors.forEach(error => showToast(error.message));
                    return;
                }
            }
            showToast("An Unknown error occurred");
        }
    }, []);

    async function handleSubmit(event) {
        try {
            await BackendApi.V1.Kingdoms.create(number, seed, councilDriven, focus, migrationStatus, governorId);
            window.location.reload();
        } catch (e) {
            if (e.response) {
                const errors = e.response.data.errors;
                if (errors) {
                    errors.forEach(error => showToast(error.message));
                    return;
                }
            }
            showToast("An Unknown error occurred");
        }
    }

    return (
        <div className={"modal fade"} id={"createKingdomModal"} tabIndex={-1} role={"dialog"}>
            <div className={"modal-dialog"} role={"document"}>
                <div className={"modal-content"}>
                    <div className={"modal-header"}>
                        <button type={"button"} className={"close"} data-dismiss={"modal"}><span aria-hidden={true}>&times;</span></button>
                        <h4 className={"modal-title"}>Create a new Kingdom</h4>
                    </div>
                    <div className={"modal-body"}>
                        <form onSubmit={handleSubmit}>
                            <div className={"form-group"}>
                                <label>Choose Profile which will be the Manager</label>
                                <Select
                                    options={attributes.profiles}
                                    onChange={(value, action) => setGovernorId(value.value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Kingdom Number</label>
                                <input type={"number"} value={number} required={true} className={"form-control"} onChange={e => setNumber(parseInt(e.target.value))} />
                                <span className="help-block">{number !== "" ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                            <div className={"form-group"}>
                                <label>Seed</label>
                                <Select
                                    options={attributes.seeds}
                                    onChange={(value, action) => setSeed(value.value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Migration Status</label>
                                <Select
                                    options={attributes.migration_status}
                                    onChange={(value, action) => setMigrationStatus(value.value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Focus</label>
                                <Select
                                    options={attributes.focus}
                                    onChange={(value, action) => setFocus(value.value)}
                                />
                            </div>
                            <div className={"checkbox"}>
                                <label>
                                    <input type={"checkbox"} value={String(councilDriven)} onChange={e => setCouncilDriven(Boolean(e.target.value))} />
                                    Is this Kingdom run by a council?
                                </label>
                            </div>
                        </form>
                    </div>
                    <div className={"modal-footer"}>
                        <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onClick={handleSubmit} data-dismiss="modal" className="btn btn-primary">Save Kingdom</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default {
    CreateKingdomModal,
    ShowModalButton,
}