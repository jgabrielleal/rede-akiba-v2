import { Outlet } from "react-router-dom";
import Navbar from "@/components/layout/Navbar";
import Rodape from "@/components/layout/Rodape";

export default function Layout() {
  return (
    <>
      <Navbar />
      <div className="bg-azul-escuro bg-fixed pb-10">
        <Outlet />
      </div>
      <Rodape tipo="interno" />
    </>
  );
}
