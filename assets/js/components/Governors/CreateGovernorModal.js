import React, {useEffect, useState} from "react";
import Select from 'react-select'
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";

export const ShowModalButton = () =>
    <button
        type={"button"}
        onClick={() => $('#createGovernorModal').show()}
        className={"btn btn-primary"}
        data-toggle={"modal"}
        data-target={"#createGovernorModal"}>
        Create New Governor
    </button>

export const CreateGovernorModal = () => {
    const [name, setName] = useState("");
    const [gameId, setGameId] = useState(0);
    const [power, setPower] = useState(0);
    const [type, setType] = useState("");
    const [attributes, setAttributes] = useState({
        types: [],
    })

    async function handleSubmit(event) {
        try {
            await BackendApi.V1.Governors.create(name, gameId, power, type);
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

    useEffect(async () => {
        const res = await BackendApi.V1.Governors.attributes();
        const data = res.data.data;

        setAttributes({
            types: data.types.map((item) => {
                return {value: item, label: item};
            }),
        })
    }, []);

    return (
        <div className={"modal fade"} id={"createGovernorModal"} tabIndex={-1} role={"dialog"}>
            <div className={"modal-dialog"} role={"document"}>
                <div className={"modal-content"}>
                    <div className={"modal-header"}>
                        <button type={"button"} className={"close"} data-dismiss={"modal"}><span aria-hidden={true}>&times;</span></button>
                        <h4 className={"modal-title"}>Create a new Governor</h4>
                    </div>
                    <div className={"modal-body"}>
                        <form onSubmit={handleSubmit}>
                            <div className={"form-group"}>
                                <label>Governor Name</label>
                                <input type={"text"} value={name} required={true} className={"form-control"} onChange={e => setName(e.target.value)} />
                                <span className="help-block">{name !== "" ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                            <div className={"form-group"}>
                                <label>Type</label>
                                <Select
                                    options={attributes.types}
                                    onChange={(value, action) => setType(value.value)}
                                />
                            </div>
                            <div className={"form-group"}>
                                <label>Governor ID</label>
                                <input type={"number"} required={true} value={gameId} className={"form-control"} onChange={e => setGameId(parseInt(e.target.value))} min={1}/>
                                <span className="help-block">{gameId > 0 ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                            <div className={"form-group"}>
                                <label>Governor Power</label>
                                <input type={"number"} required={true} value={power} className={"form-control"} onChange={e => setPower(parseInt(e.target.value))} min={1}/>
                                <span className="help-block">{power > 0 ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                        </form>
                    </div>
                    <div className={"modal-footer"}>
                        <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onClick={handleSubmit} data-dismiss="modal" className="btn btn-primary">Save Governor</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default {
    CreateGovernorModal,
    ShowModalButton,
}