import { toast } from 'react-toastify';
import { useForm } from 'react-hook-form';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useUsuarios } from '@/services/usuarios/queries';
import { useCreatePrograma } from '@/services/programas/mutations';
import { OffcanvasClose } from '@/components/layout/Offcanvas';

export default function NovoPrograma() {
    const { handleSubmit, register, setValue, reset } = useForm();

    const { converter, preview, setPreview } = useImagePreview();

    const { data: usuarios } = useUsuarios();
    const { mutate: createPrograma } = useCreatePrograma(() => {
        toast.success("(ﾉ´ з `)ノ Yeeeeeeeeeh! Sugoi!   O programa foi cadastrado");
        setPreview('');
        reset();
        OffcanvasClose();
    });

    function onSubmit(data: any) {
        createPrograma(data);
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <div className="mb-3">
                <label htmlFor="logoDoPrograma" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                    { 'h-36 bg-aurora': !preview }
                )}>
                    {preview ? (
                        <img src={preview} alt="logoPrograma" className="w-full h-36 bg-aurora rounded-md object-cover" />
                    ) : (
                        "+"
                    )}
                </label>
                <input
                    {...register("logo_do_programa")}
                    type="file"
                    id="logoDoPrograma"
                    className="hidden"
                    onChange={(e) => { converter(e, setValue, 'logo_do_programa') }}
                />
            </div>
            <div className="mb-5">
                <label htmlFor="locutor" className="font-averta font-bold text-azul-claro text-md uppercase block mb-1">
                    Locutor
                </label>
                <select
                    {...register('locutor')}
                    name="locutor"
                    id="locutor"
                    className="w-full bg-aurora border-2 border-azul-claro outline-none rounded-lg font-averta p-2"
                >
                    <option value=""></option>
                    {usuarios?.data?.filter((usuario: { niveis_de_acesso: string[] }) => 
                        usuario.niveis_de_acesso.includes('locutor') || usuario.niveis_de_acesso.includes('administrador')
                    ).map((usuario: { id: string; apelido: string }) => (
                        <option key={usuario.id} value={usuario.id}>{usuario.apelido}</option>
                    ))}
                </select>
            </div>
            <div className="mb-5">
                <label htmlFor="nome_do_programa" className="font-averta font-bold text-azul-claro text-md uppercase block mb-1">
                    Programa
                </label>
                <input
                    {...register('nome_do_programa')}
                    type="text"
                    name="nome_do_programa"
                    id="nome_do_programa"
                    className="w-full bg-aurora border-2 border-azul-claro outline-none rounded-lg font-averta p-2"
                />
            </div>
            <div className="flex items-center mb-4">
                <input 
                    {...register('auto_dj')}
                    id="auto_dj" 
                    type="checkbox" 
                    value="1" 
                    name="auto_dj"
                />
                <label htmlFor="auto_dj" className="ms-2 text-sm font-averta">
                    Este programa servirá como AUTO DJ?
                </label>
            </div>
            <button className="w-full bg-azul-claro text-aurora font-averta font-bold text-md uppercase p-2 rounded-md">
                Cadastrar
            </button>
        </form>
    )
}