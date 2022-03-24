import { Controller } from 'stimulus';
import React, {useEffect, useState} from "react"
import ReactDOM from "react-dom"
import BackendApi from "../../lib/BackendApi";
import Post from "../../components/News/NewsPost";
import {CreateNewsPostModal, ShowModalButton} from "../../components/News/CreateNewsPostModal";
import showToast from "../../lib/UI/Toasts";

const Page = props => {
    const [isAdmin, setIsAdmin] = useState(false);
    useEffect(async () => {
        setIsAdmin(await BackendApi.V1.User.amIAdmin());
    }, [])

    return <div>
        <div className={"row"}>
            <div className={"col-md-12"}>
                <div className={"pull-right"}>
                    <ShowModalButton />
                </div>
            </div>
        </div>
        <CreateNewsPostModal />
        {props.posts.map(post => new Post(post))}
    </div>
}

export default class extends Controller {
    connect = () => {
        BackendApi.V1.News.getAll()
            .then(res => {
                return res.data.data;
            })
            .then(data => {
                ReactDOM.render(<Page posts={data} />, this.element)
            })
            .catch(e => {
                if (e.response) {
                    const errors = e.response.data.errors;
                    if (errors) {
                        errors.forEach(error => showToast(error.message));
                        return;
                    }
                }
                showToast("An Unknown error occurred");
            })
    };
}