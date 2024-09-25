import { BrowserRouter, Routes, Route } from 'react-router-dom';
import MiddlewareRoute from './MiddlewareRoute';
import Outlet from '@/views/Layout';
import Login from '@views/Login';
import Dashboard from '@views/Dashboard';
import Materias from '@views/Materias';
import Reviews from '@/views/Reviews';
import Eventos from '@/views/Eventos';

export default function Router(){
    return(
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Login/>} />
                <Route path="/" element={<Outlet/>}>
                    <Route path="dashboard" element={<MiddlewareRoute view={Dashboard} />} />
                    <Route path="materias/:slug?" element={<MiddlewareRoute view={Materias} />} />
                    <Route path="reviews/:slug?" element={<MiddlewareRoute view={Reviews} />} />
                    <Route path="eventos/:slug?" element={<MiddlewareRoute view={Eventos} />} />
                </Route>
            </Routes>
        </BrowserRouter>
    )
}