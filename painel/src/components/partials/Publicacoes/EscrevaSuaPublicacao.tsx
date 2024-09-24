import { useParams } from 'react-router-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import { useMateria } from "@/services/materias/queries";
import { useEvento } from "@/services/eventos/queries";
import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacao/EscrevaSuaPublicacaoPlaceholder";

export default function EscrevaSuaPublicacao() {
    const { slug, publicacao } = useParams();

    const { data: materia, isLoading: materiaLoading } = useMateria(slug ?? "");
    const { data: evento, isLoading: eventoLoading } = useEvento(slug ?? "");

    function publicacaoDispatch() {
        const tituloMap: { [key: string]: string | undefined } = {
            eventos: evento?.conteudo,
            materias: materia?.conteudo,
        };
        return tituloMap[publicacao ?? "materias"] ?? "";
    }

    if (materiaLoading || eventoLoading) {
        return <EscrevaSuaPublicacaoPlaceholder />;
    }

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
                {publicacao === "eventos" ? "Escreva sobre o evento" : "Escreva sua matéria"}
            </span>            
            <div className="bg-aurora h-96 rounded-md">
                <ReactQuill theme="snow" modules={modules} value={publicacaoDispatch()}/>
            </div>
        </section>
    );
}