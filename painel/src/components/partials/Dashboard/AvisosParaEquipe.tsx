import { MdOutlineKeyboardDoubleArrowRight } from "react-icons/md";
import { useAvisosParaEquipe } from "@/services/avisos_para_equipe/queries";

export default function AvisosParaEquipe() {
    const { data: avisosParaEquipe } = useAvisosParaEquipe();

    console.log(avisosParaEquipe);

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Avisos para equipe</h6>
            </div>
            <div className="flex justify-center gap-3 flex-wrap lg:flex-nowrap mt-3">
                <div className="w-full h-40 bg-azul-claro rounded-md p-3">
                    <h6 className="font-averta font-bold text-aurora text-xl uppercase flex items-center gap-1">
                        Takashi<MdOutlineKeyboardDoubleArrowRight className="mt-1"/>teste
                    </h6>
                    <p className="font-averta text-aurora text-xs line-clamp-6 mt-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum posuere quam eu dolor dignissim, id scelerisque augue efficitur. Cras rhoncus arcu dolor, vel tincidunt purus lobortis a. Curabitur finibus id lacus quis lacinia. Sed tempus sollicitudin nibh, eget pharetra orci. Duis semper tortor est, nec lobortis sapien laoreet a. Etiam eget purus vitae lorem feugiat dignissim. Nullam suscipit, ligula eget scelerisque vehicula, lacus velit mattis mi, et porta nulla mi eu enim. Maecenas eget justo a dolor pharetra gravida ut non urna. Curabitur vulputate elit quis nulla placerat, non tempor justo maximus. Cras sed arcu eget nunc aliquam suscipit. Proin consequat purus molestie turpis facilisis tristique.
                    </p>
                </div>
                <div className="w-full h-40 bg-azul-claro rounded-md p-3">
                    <h6 className="font-averta font-bold text-aurora text-xl uppercase flex items-center gap-1">
                        Takashi<MdOutlineKeyboardDoubleArrowRight className="mt-1"/>teste
                    </h6>
                    <p className="font-averta text-aurora text-xs line-clamp-6 mt-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum posuere quam eu dolor dignissim, id scelerisque augue efficitur. Cras rhoncus arcu dolor, vel tincidunt purus lobortis a. Curabitur finibus id lacus quis lacinia. Sed tempus sollicitudin nibh, eget pharetra orci. Duis semper tortor est, nec lobortis sapien laoreet a. Etiam eget purus vitae lorem feugiat dignissim. Nullam suscipit, ligula eget scelerisque vehicula, lacus velit mattis mi, et porta nulla mi eu enim. Maecenas eget justo a dolor pharetra gravida ut non urna. Curabitur vulputate elit quis nulla placerat, non tempor justo maximus. Cras sed arcu eget nunc aliquam suscipit. Proin consequat purus molestie turpis facilisis tristique.
                    </p>
                </div>
                <div className="w-full h-40 bg-azul-claro rounded-md p-3">
                    <h6 className="font-averta font-bold text-aurora text-xl uppercase flex items-center gap-1">
                        Takashi<MdOutlineKeyboardDoubleArrowRight className="mt-1"/>teste
                    </h6>
                    <p className="font-averta text-aurora text-xs line-clamp-6 mt-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum posuere quam eu dolor dignissim, id scelerisque augue efficitur. Cras rhoncus arcu dolor, vel tincidunt purus lobortis a. Curabitur finibus id lacus quis lacinia. Sed tempus sollicitudin nibh, eget pharetra orci. Duis semper tortor est, nec lobortis sapien laoreet a. Etiam eget purus vitae lorem feugiat dignissim. Nullam suscipit, ligula eget scelerisque vehicula, lacus velit mattis mi, et porta nulla mi eu enim. Maecenas eget justo a dolor pharetra gravida ut non urna. Curabitur vulputate elit quis nulla placerat, non tempor justo maximus. Cras sed arcu eget nunc aliquam suscipit. Proin consequat purus molestie turpis facilisis tristique.
                    </p>
                </div>
                <div className="w-full h-40 bg-azul-claro rounded-md p-3">
                    <h6 className="font-averta font-bold text-aurora text-xl uppercase flex items-center gap-1">
                        Takashi<MdOutlineKeyboardDoubleArrowRight className="mt-1"/>teste
                    </h6>
                    <p className="font-averta text-aurora text-xs line-clamp-6 mt-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum posuere quam eu dolor dignissim, id scelerisque augue efficitur. Cras rhoncus arcu dolor, vel tincidunt purus lobortis a. Curabitur finibus id lacus quis lacinia. Sed tempus sollicitudin nibh, eget pharetra orci. Duis semper tortor est, nec lobortis sapien laoreet a. Etiam eget purus vitae lorem feugiat dignissim. Nullam suscipit, ligula eget scelerisque vehicula, lacus velit mattis mi, et porta nulla mi eu enim. Maecenas eget justo a dolor pharetra gravida ut non urna. Curabitur vulputate elit quis nulla placerat, non tempor justo maximus. Cras sed arcu eget nunc aliquam suscipit. Proin consequat purus molestie turpis facilisis tristique.
                    </p>
                </div>
            </div>
        </section>
    )
}