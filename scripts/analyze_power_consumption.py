import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

# Load the data
df_monolith = pd.read_csv('monolith_power_consumption.csv')
df_microservices = pd.read_csv('microservices_power_consumption.csv')

# Add a column to identify the type of application
df_monolith['Application Type'] = 'Monolith'
df_microservices['Application Type'] = 'Microservices'

# Combine the dataframes
df = pd.concat([df_monolith, df_microservices], ignore_index=True)

# Convert 'Tijd' to a numeric type, if not already
df['Tijd'] = pd.to_numeric(df['Tijd'], errors='coerce')

# Convert Energie columns to numeric types, if not already
df['CPU Energie'] = pd.to_numeric(df['CPU Energie'], errors='coerce')
df['GPU Energie'] = pd.to_numeric(df['GPU Energie'], errors='coerce')
df['Total Energie'] = pd.to_numeric(df['Total Energie'], errors='coerce')

# Plotting
sns.set(style="whitegrid")

# Plot 1: Total Energy Consumption Comparison
plt.figure(figsize=(12, 6))
sns.barplot(x='Scenario', y='Total Energie', hue='Application Type', data=df)
plt.title('Total Energy Consumption Comparison')
plt.xlabel('Scenario')
plt.ylabel('Total Energy')
plt.legend(title='Application Type')
plt.savefig('total_energy_comparison.png')
plt.show()

# Plot 2: CPU and GPU Energy Consumption Comparison
plt.figure(figsize=(12, 6))
df_melted = df.melt(id_vars=['Scenario', 'Ronde', 'Application Type'], 
                    value_vars=['CPU Energie', 'GPU Energie'], 
                    var_name='Energy Type', value_name='Energy')
sns.barplot(x='Scenario', y='Energy', hue='Application Type', data=df_melted, ci=None)
plt.title('CPU and GPU Energy Consumption Comparison')
plt.xlabel('Scenario')
plt.ylabel('Energy')
plt.legend(title='Application Type')
plt.savefig('cpu_gpu_energy_comparison.png')
plt.show()

# Plot 3: Total Time Comparison
plt.figure(figsize=(12, 6))
sns.barplot(x='Scenario', y='Tijd', hue='Application Type', data=df)
plt.title('Total Time Comparison')
plt.xlabel('Scenario')
plt.ylabel('Total Time')
plt.legend(title='Application Type')
plt.savefig('total_time_comparison.png')
plt.show()

# Plot 4: Distribution of Total Energy Consumption
plt.figure(figsize=(12, 6))
sns.boxplot(x='Scenario', y='Total Energie', hue='Application Type', data=df)
plt.title('Distribution of Total Energy Consumption')
plt.xlabel('Scenario')
plt.ylabel('Total Energy')
plt.legend(title='Application Type')
plt.savefig('energy_distribution_comparison.png')
plt.show()

