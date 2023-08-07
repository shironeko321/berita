import React, { useState } from "react";

import Header from "../Components//dashboard/header";
import Menu from "../Components//dashboard/menu";

import DashboardContent from "../Components//dashboard/contents/dashboard";
import ArticleContent from "../Components//dashboard/contents/article";
import AdminContent from "../Components//dashboard/contents/admin";

export default function Dashboard({ content }) {
  const [menu, setMenu] = useState(true);
  const [selectMenu, setSelectMenu] = useState(content);

  const navigation = [
    { nav: "dashboard", view: <DashboardContent /> },
    { nav: "article", view: <ArticleContent /> },
    { nav: "admin", view: <AdminContent /> },
  ];

  const openCloseMenu = () => setMenu((current) => !current);
  const changeView = (view) => setSelectMenu(view);

  return (
    <div className="flex h-screen flex-col overflow-hidden">
      <Header openCloseMenu={openCloseMenu} />
      <main className="flex flex-1">
        <Menu
          open={menu}
          selectMenu={selectMenu}
          navigation={navigation}
          changeView={changeView}
        />
        <div className="m-8 w-full">
          {navigation.map((value) => value.nav === selectMenu && value.view)}
        </div>
      </main>
    </div>
  );
}
