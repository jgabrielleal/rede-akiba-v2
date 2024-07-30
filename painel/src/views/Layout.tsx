import { Outlet } from "react-router-dom";
import Navbar from "@/layout/Navbar";

export default function Layout() {
  return (
    <>
      <Navbar/>
      <div className="h-screen bg-azul-escuro">
      <Outlet/>
      </div>
    </>
  );
}
