import React, {useEffect, useState} from "react";
import Select from 'react-select'
import BackendApi from "../../lib/BackendApi";
import showToast from "../../lib/UI/Toasts";
import MDEditor from '@uiw/react-md-editor';

export const ShowModalButton = () =>
    <button
        type={"button"}
        //onClick={() => $('#createNewsPostModal').show()}
        className={"btn btn-primary"}
        data-toggle={"modal"}
        data-target={"#createNewsPostModal"}>
        Create New Post
    </button>

export const CreateNewsPostModal = () => {
    const [title, setTitle] = useState("");
    const [body, setBody] = useState("");

    async function handleSubmit() {
        try {
            await BackendApi.V1.News.create(title, body);
            //$('#createNewsPostModal').modal('hide');
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
        <div className={"modal fade"} id={"createNewsPostModal"} tabIndex={-1} role={"dialog"}>
            <div className={"modal-dialog"} role={"document"}>
                <div className={"modal-content"}>
                    <div className={"modal-header"}>
                        <button type={"button"} className={"close"} data-dismiss={"modal"}><span aria-hidden={true}>&times;</span></button>
                        <h4 className={"modal-title"}>Create a new News Post</h4>
                    </div>
                    <div className={"modal-body"}>
                        <form onSubmit={handleSubmit}>
                            <div className={"form-group"}>
                                <label>Title</label>
                                <input type={"text"} required={true} className={"form-control"} onChange={e => setTitle(e.target.value)} />
                                <span className="help-block">{title !== "" ? 'Looks Good' : 'Field Required'}</span>
                            </div>
                            <div className={"form-group"}>
                                <label>Body</label>
                                <MDEditor
                                    value={body}
                                    onChange={setBody}
                                />
                                <MDEditor.Markdown source={body} />
                            </div>
                        </form>
                    </div>
                    <div className={"modal-footer"}>
                        <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onClick={handleSubmit} data-dismiss="modal" className="btn btn-primary">Save Post</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default {
    CreateNewsPostModal,
    ShowModalButton,
}