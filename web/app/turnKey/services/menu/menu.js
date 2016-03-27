/**
 * This service will give a short cut for adding standard menu items to a Turn-Key site.
 */
angular.module('engState').provider('tkMenu', function ()
{
  this.latestTopLevelItem = null;

  this.state = null;
  this.menuKey = null;

  this.topLevelPosition = 1;
  this.childPosition = 1;


  /**
   * This method sets basic data that will start to build on a particular menu.
   *
   * @param state
   * @param menuKey
   */
  this.buildMenu = function (stateParam, menuKeyParam)
  {
    this.state = stateParam;
    this.menuKey = menuKeyParam;
  };

  /**
   * This method adds a top-level menu item.
   *
   * @param name
   * @param viewName
   * @param title
   * @param url
   */
  this.addTopLevelMenuItem = function (name, viewName, title, url)
  {
    menuItemDefinition = this.buildMenuItemDefinition(name, viewName, title, url);
    this.state.add(menuItemDefinition);

    // Move to the next top level position when the next top-level menu item is added, and if children are added
    // now, they will start at 1 since we are now on a new top-level item.
    ++this.topLevelPosition;
    this.childPosition = 1;

    // remember this menuItem because if child menu items are added, they will need to mark
    // this item as their parent
    this.latestTopLevelItem = menuItemDefinition;
  };

  /**
   * This method adds a child menu item to the latest top-level item that was added.
   *
   * @param name
   * @param viewName
   * @param title
   * @param url
   */
  this.addChildMenuItem = function (name, viewName, title, url)
  {
    menuItemDefinition = this.buildMenuItemDefinition(name, viewName, title, url);
    menuItemDefinition['parent'] = this.latestTopLevelItem.name;
    this.state.add(menuItemDefinition);

    ++this.childPosition;
  };

  /**
   * This method will setup the basic data for a new menu item. These are things all menu items have in common.
   *
   * @param name
   * @param viewName
   * @param title
   * @param url
   */
  this.buildMenuItemDefinition = function (name, viewName, title, url)
  {
    var menuItemDefinition = {
      name: name,
      view: viewName,
      title: title,
      url: url,
      role: 'ROLE_ALL'
    };

    menuItemDefinition.menus = {};
    menuItemDefinition.menus[this.menuKey] = this.topLevelPosition;

    return menuItemDefinition;
  };

  this.$get = function ()
  {
    return {
      data: {},

      buildMenu: this.buildMenu,
      addTopLevelMenuItem: this.addTopLevelMenuItem,
      addChildMenuItem: this.addChildMenuItem
    };
  };


});