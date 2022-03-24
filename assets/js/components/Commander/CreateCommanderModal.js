import React, {useEffect, useState} from "react";
import Select from 'react-select'
import BackendApi from "../../lib/BackendApi";
import Toastify from "toastify-js";
import showToast from "../../lib/UI/Toasts";

export const ShowModalButton = () =>
    <button
        type={"button"}
        onClick={() => $('#createCommanderModal').show()}
        className={"btn btn-primary"}
        data-toggle={"modal"}
        data-target={"#createCommanderModal"}>
        Create New Commander
    </button>

export const CreateCommanderModal = () => {
    const [name, setName] = useState("");
    const [features, setFeatures] = useState([]);
    const [rarity, setRarity] = useState("");
    const [obtainedFrom, setObtainedFrom] = useState("");
    const [kingdomAge, setKingdomAge] = useState(0);
    const [attributes, setAttributes] = useState({
        features: [],
        rarity: [],
        obtained_from: [],
    })

    async function handleSubmit(event) {
        try {
            await BackendApi.V1.Commander.create(name, features, rarity, obtainedFrom, kingdomAge);
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

    useEffect(async () => {
        const res = await BackendApi.V1.Commander.attributes();
        const data = res.data.data;

        setAttributes({
                features: data.features.map((item) => {
                    return {value: item, label: item};
                }),
                rarity: data.rarity.map((item) => {
                    return {value: item, label: item};
                }),
                obtained_from: data.obtained_from.map((item) => {
                    return {value: item, label: item}
                })
            }
        )
    }, []);

    return (
        <div className={"modal fade"} id={"createCommanderModal"} tabIndex={-1} role={"dialog"}>
            <div className={"modal-dialog"} role={"document"}>
                <div className={"modal-content"}>
                    <div className={"modal-header"}>
                        <button type={"button"} className={"close"} data-dismiss={"modal"}><span aria-hidden={true}>&times;</span></button>
                        <h4 className={"modal-title"}>Create a new Commander</h4>
                    </div>
                    <div className={"modal-body"}>
                        <form onSubmit={handleSubmit}>
                            <div className={"form-group"}>
                                <label>Commander Name</label>
                                <input type={"text"} required={true} className={"form-control"} onChange={e => setName(e.target.value)} />
                                <span className="help-block">{name !== "" ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                            <div className={"form-group"}>
                                <label>Commander Features</label>
                                <Select
                                    options={features.length < 3 ? attributes.features : []}
                                    isMulti={true}
                                    isClearable={features.length < 3}
                                    isSearchable={features.length < 3}
                                    isMenuOpen={features.length < 3}
                                    onChange={(value, action) => setFeatures(value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Commander Rarity</label>
                                <Select
                                    options={attributes.rarity}
                                    onChange={(value, action) => setRarity(value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Obtained From</label>
                                <Select
                                    options={attributes.obtained_from}
                                    onChange={(value, action) => setObtainedFrom(value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Kingdom Age on Release</label>
                                <input type={"number"} required={true} className={"form-control"} onChange={e => setKingdomAge(parseInt(e.target.value))} min={1}/>
                                <span className="help-block">{kingdomAge > 0 ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                        </form>
                    </div>
                    <div className={"modal-footer"}>
                        <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onClick={handleSubmit} data-dismiss="modal" className="btn btn-primary">Save Commander</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default {
    CreateCommanderModal,
    ShowModalButton,
}