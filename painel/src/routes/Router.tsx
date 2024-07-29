import { BrowserRouter, Routes, Route } from 'react-router-dom';
import MiddlewareRoute from './MiddlewareRoute';
import Login from '@views/Login';
import Layout from '@/views/Layout';
import Dashboard from '@views/Dashboard';

export default function Router(){
    return(
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Login/>} />
                <Route path="/" element={<Layout/>}>
                    <Route path="dashboard" element={<MiddlewareRoute view={Dashboard} />} />
                </Route>
            </Routes>
        </BrowserRouter>
    )
}