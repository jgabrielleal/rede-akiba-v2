import { Outlet } from "react-router-dom";

import Navbar from "@/layout/Navbar";
import Rodape from "@/layout/Rodape";

export default function Layout() {
  return (
    <>
      <Navbar />
      <div className="h-screen bg-azul-escuro">
        <Outlet />
      </div>
      <Rodape tipo="interno" />
    </>
  );
}
