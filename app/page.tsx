"use client"

import { useState } from "react"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Button } from "@/components/ui/button"
import { Badge } from "@/components/ui/badge"
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { Progress } from "@/components/ui/progress"
import {
  ShoppingBag,
  Users,
  Package,
  TrendingUp,
  DollarSign,
  Eye,
  Plus,
  Search,
  Bell,
  Settings,
  BarChart3,
  ShoppingCart,
  UserCheck,
} from "lucide-react"

export default function Dashboard() {
  const [activeSection, setActiveSection] = useState("overview")

  // Datos de ejemplo para el dashboard
  const stats = [
    {
      title: "Ventas Totales",
      value: "$45,231",
      change: "+20.1%",
      icon: DollarSign,
      color: "text-primary",
    },
    {
      title: "Pedidos",
      value: "1,234",
      change: "+15.3%",
      icon: ShoppingCart,
      color: "text-chart-2",
    },
    {
      title: "Productos",
      value: "567",
      change: "+2.5%",
      icon: Package,
      color: "text-chart-3",
    },
    {
      title: "Usuarios",
      value: "8,945",
      change: "+12.8%",
      icon: Users,
      color: "text-chart-4",
    },
  ]

  const recentOrders = [
    { id: "#001", customer: "María García", amount: "$89.99", status: "Completado", date: "2024-01-15" },
    { id: "#002", customer: "Carlos López", amount: "$156.50", status: "Procesando", date: "2024-01-15" },
    { id: "#003", customer: "Ana Martínez", amount: "$234.00", status: "Enviado", date: "2024-01-14" },
    { id: "#004", customer: "Luis Rodríguez", amount: "$67.25", status: "Pendiente", date: "2024-01-14" },
  ]

  const topProducts = [
    { name: "Camisa Casual Azul", sales: 145, revenue: "$2,175", image: "/imagenes/camisa.webp" },
    { name: "Vestido Elegante Negro", sales: 98, revenue: "$1,960", image: "/imagenes/camisamujer.jpg" },
    { name: "Pantalón Deportivo", sales: 87, revenue: "$1,305", image: "/placeholder.svg?height=40&width=40" },
    { name: "Zapatos Casuales", sales: 76, revenue: "$1,520", image: "/placeholder.svg?height=40&width=40" },
  ]

  const menuItems = [
    { id: "overview", label: "Resumen", icon: BarChart3 },
    { id: "products", label: "Productos", icon: Package },
    { id: "orders", label: "Pedidos", icon: ShoppingCart },
    { id: "customers", label: "Clientes", icon: Users },
    { id: "analytics", label: "Analytics", icon: TrendingUp },
    { id: "settings", label: "Configuración", icon: Settings },
  ]

  return (
    <div className="min-h-screen bg-background">
      {/* Sidebar */}
      <div className="fixed left-0 top-0 h-full w-64 bg-card border-r border-border">
        <div className="p-6">
          <div className="flex items-center gap-2 mb-8">
            <div className="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
              <ShoppingBag className="w-5 h-5 text-primary-foreground" />
            </div>
            <h1 className="font-montserrat font-black text-xl text-foreground">GLOW SHOW UP</h1>
          </div>

          <nav className="space-y-2">
            {menuItems.map((item) => (
              <button
                key={item.id}
                onClick={() => setActiveSection(item.id)}
                className={`w-full flex items-center gap-3 px-3 py-2 rounded-lg text-left transition-colors ${
                  activeSection === item.id
                    ? "bg-primary text-primary-foreground"
                    : "text-muted-foreground hover:bg-muted hover:text-foreground"
                }`}
              >
                <item.icon className="w-5 h-5" />
                <span className="font-open-sans">{item.label}</span>
              </button>
            ))}
          </nav>
        </div>
      </div>

      {/* Main Content */}
      <div className="ml-64 p-6">
        {/* Header */}
        <div className="flex items-center justify-between mb-8">
          <div>
            <h2 className="font-montserrat font-bold text-3xl text-foreground">Panel de Control</h2>
            <p className="text-muted-foreground font-open-sans">Gestiona tu tienda de ropa en línea</p>
          </div>

          <div className="flex items-center gap-4">
            <Button variant="outline" size="sm">
              <Search className="w-4 h-4 mr-2" />
              Buscar
            </Button>
            <Button variant="outline" size="sm">
              <Bell className="w-4 h-4" />
            </Button>
            <Avatar>
              <AvatarImage src="/placeholder.svg?height=32&width=32" />
              <AvatarFallback>AD</AvatarFallback>
            </Avatar>
          </div>
        </div>

        {/* Stats Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          {stats.map((stat, index) => (
            <Card key={index} className="bg-card border-border">
              <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                <CardTitle className="text-sm font-open-sans font-medium text-card-foreground">{stat.title}</CardTitle>
                <stat.icon className={`h-4 w-4 ${stat.color}`} />
              </CardHeader>
              <CardContent>
                <div className="text-2xl font-montserrat font-bold text-card-foreground">{stat.value}</div>
                <p className="text-xs text-muted-foreground">
                  <span className="text-chart-2">{stat.change}</span> desde el mes pasado
                </p>
              </CardContent>
            </Card>
          ))}
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          {/* Recent Orders */}
          <Card className="bg-card border-border">
            <CardHeader>
              <div className="flex items-center justify-between">
                <div>
                  <CardTitle className="font-montserrat font-bold text-card-foreground">Pedidos Recientes</CardTitle>
                  <CardDescription className="font-open-sans">Últimos pedidos realizados</CardDescription>
                </div>
                <Button variant="outline" size="sm">
                  <Eye className="w-4 h-4 mr-2" />
                  Ver todos
                </Button>
              </div>
            </CardHeader>
            <CardContent>
              <div className="space-y-4">
                {recentOrders.map((order) => (
                  <div key={order.id} className="flex items-center justify-between p-3 bg-muted rounded-lg">
                    <div className="flex items-center gap-3">
                      <Avatar className="h-8 w-8">
                        <AvatarFallback className="text-xs">
                          {order.customer
                            .split(" ")
                            .map((n) => n[0])
                            .join("")}
                        </AvatarFallback>
                      </Avatar>
                      <div>
                        <p className="font-open-sans font-medium text-sm text-foreground">{order.customer}</p>
                        <p className="text-xs text-muted-foreground">
                          {order.id} • {order.date}
                        </p>
                      </div>
                    </div>
                    <div className="text-right">
                      <p className="font-montserrat font-semibold text-sm text-foreground">{order.amount}</p>
                      <Badge variant={order.status === "Completado" ? "default" : "secondary"} className="text-xs">
                        {order.status}
                      </Badge>
                    </div>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>

          {/* Top Products */}
          <Card className="bg-card border-border">
            <CardHeader>
              <div className="flex items-center justify-between">
                <div>
                  <CardTitle className="font-montserrat font-bold text-card-foreground">Productos Populares</CardTitle>
                  <CardDescription className="font-open-sans">Productos más vendidos este mes</CardDescription>
                </div>
                <Button variant="outline" size="sm">
                  <Plus className="w-4 h-4 mr-2" />
                  Agregar
                </Button>
              </div>
            </CardHeader>
            <CardContent>
              <div className="space-y-4">
                {topProducts.map((product, index) => (
                  <div key={index} className="flex items-center gap-4 p-3 bg-muted rounded-lg">
                    <img
                      src={product.image || "/placeholder.svg"}
                      alt={product.name}
                      className="w-12 h-12 rounded-lg object-cover bg-background"
                    />
                    <div className="flex-1">
                      <p className="font-open-sans font-medium text-sm text-foreground">{product.name}</p>
                      <p className="text-xs text-muted-foreground">{product.sales} ventas</p>
                    </div>
                    <div className="text-right">
                      <p className="font-montserrat font-semibold text-sm text-foreground">{product.revenue}</p>
                      <Progress value={(product.sales / 150) * 100} className="w-16 h-2 mt-1" />
                    </div>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Quick Actions */}
        <Card className="bg-card border-border">
          <CardHeader>
            <CardTitle className="font-montserrat font-bold text-card-foreground">Acciones Rápidas</CardTitle>
            <CardDescription className="font-open-sans">Tareas comunes de administración</CardDescription>
          </CardHeader>
          <CardContent>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <Button className="h-20 flex-col gap-2 bg-primary hover:bg-primary/90 text-primary-foreground">
                <Plus className="w-6 h-6" />
                <span className="font-open-sans">Agregar Producto</span>
              </Button>
              <Button variant="outline" className="h-20 flex-col gap-2 bg-transparent">
                <UserCheck className="w-6 h-6" />
                <span className="font-open-sans">Gestionar Usuarios</span>
              </Button>
              <Button variant="outline" className="h-20 flex-col gap-2 bg-transparent">
                <BarChart3 className="w-6 h-6" />
                <span className="font-open-sans">Ver Reportes</span>
              </Button>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
