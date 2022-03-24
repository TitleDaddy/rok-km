import React from "react"
import ReactTimeAgo from "react-time-ago";
import ReactMarkdown from 'react-markdown'
const Post = post =>
    <div className={"col-lg-12"} key={post.updated_at}>
        <div className={"row"}>
            <div className="box box-primary">
                <div className={"box-header with-border"}>
                    <h3 className={"box-title"}>{post.title}</h3>
                </div>
                <div className={"box-body"}><ReactMarkdown>{post.body}</ReactMarkdown></div>
                <div className={"box-footer"}>
                    Written By {post.author} - <ReactTimeAgo date={post.updated_at * 1000} />
                </div>
            </div>
        </div>
    </div>

export default Post;