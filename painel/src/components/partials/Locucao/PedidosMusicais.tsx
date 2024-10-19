import { IoPersonCircleSharp } from "react-icons/io5";
import { IoMdClock } from "react-icons/io";
import { FaSave, FaMapMarkerAlt } from "react-icons/fa";
import { MdLibraryMusic } from "react-icons/md";
import { FaTrashCan } from "react-icons/fa6";

export default function PedidosMusicais() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Pedidos musicais</h6>
            </div>
            <div className="flex justify-center">
                <button className="my-5 px-10 py-1 border-4 border-creme rounded-xl font-averta font-bold text-creme text-xl text-creme uppercase">
                    Para de receber
                </button>
            </div>
            <div className="flex flex-wrap gap-3 mt-3">
                {[...Array(10)].map((_, index) => (
                    <div key={index} className="w-full lg:w-[18.16rem] p-3 bg-azul-claro rounded-md">
                        <div className="mb-3">
                            <h5 className="flex gap-1 text-aurora text-lg font-averta font-bold uppercase leading-5">
                                <IoPersonCircleSharp />Maria Fernanda Firmeza Claro
                            </h5>
                            <h6 className="flex items-center gap-1 text-aurora text-sm font-averta mt-1">
                                <FaMapMarkerAlt />Rio de Janeiro - RJ
                            </h6>
                        </div>
                        <div className="icone-divisoria-pedidos mb-3">
                            <span>
                                <MdLibraryMusic />
                            </span>
                        </div>
                        <p className="font-averta text-aurora text-sm line-clamp-6 mb-3">
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </p>
                        <div className="flex justify-between">
                            <span className="flex gap-1 items-center font-averta text-aurora uppercase">
                                <IoMdClock /> 10:00
                            </span>
                            <div className="flex gap-2">
                                <button className="text-xl font-averta text-aurora">
                                    <FaSave />
                                </button>
                                <button className="text-xl font-averta text-aurora">
                                    <FaTrashCan />
                                </button>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    )
}