import {Route, Routes} from "react-router-dom";
import ContainerDefault from "./components/containers/default/ContainerDefault.tsx";
import NoMatch from "./components/pages/NoMatch.tsx";
import CategoriesListPage from "./components/categories/list/CategoriesListPage.tsx";

const App: React.FC = () => {

    return (
        <>
            <Routes>
                <Route path="/" element={<ContainerDefault />}>
                    <Route index element={<CategoriesListPage />} />

                    <Route path="*" element={<NoMatch />} />
                </Route>
            </Routes>
        </>
    );
};

export default App;