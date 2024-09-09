import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';

export default function EscrevaSuaPublicacao() {

    const modules = {
        toolbar: [
            [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'align': [] }],
            [{ 'color': [] }, { 'background': [] }],
            ['link', 'image', 'video'],
            ['clean'] // remove formatting button
        ]
    };

    return (
        <section>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Escrever matéria
            </span>            
            <div className="bg-aurora h-96 rounded-md">
                <ReactQuill theme="snow" modules={modules} />
            </div>
        </section>
    );
}